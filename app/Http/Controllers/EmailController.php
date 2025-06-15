<?php

namespace App\Http\Controllers;

use App\Mail\Register;
use App\Models\NewslatterMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class EmailController extends Controller
{
    public function register(Request $request)
    {
        $existingMail = NewslatterMail::where('email', $request->email)->first();

        if ($existingMail) {
            return back()->with([
                'message' => 'Este e-mail já está inscrito em nossa newsletter. Fique ligado(a) nas novidades! 😉',
                'status' => false
            ]);
        }

        try {
            $validated = $request->validate([
                'email' => 'required|email', 
            ]);
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }

        $mail = new NewslatterMail();
        $mail->email = $validated['email'];
        $mail->active = true;
        $mail->created_at = now();
        $mail->updated_at = null;
        $mail->save();

        try {
            // Send the email, passing the raw email to the Mailable
            Mail::to($mail->email)->send(new Register($mail->email));
        } catch (\Exception $e) {

            return back()->with([
                'message' => 'Ocorreu uma inconsistência ao confirmar seu e-mail. Por favor, tente novamente mais tarde. 😥',
                'status' => false
            ]);
        }

        return back()->with([
            'message' => 'Inscrição realizada com sucesso! Você receberá um e-mail de confirmação em breve. 🎉',
            'status' => true
        ]);
    }

    public function unregister(Request $request)
    {

        $email = $request->query('mail');
        if($request->has('decode')){
           $email = base64_decode($email); 
        }

        $query = NewslatterMail::where('email', $email);

        if (!$query) {
            return  view('public.unsub', [
                'message' => 'Este e-mail não está inscrito em nossa newsletter.',
                'status' => false
            ]);
        }

        $query->delete();

        return view('public.unsub', [
            'message' => 'Você foi removido(a) com sucesso da nossa lista de e-mails. Esperamos vê-lo(a) novamente em breve! 😊',
            'status' => true
        ]);
    }
}