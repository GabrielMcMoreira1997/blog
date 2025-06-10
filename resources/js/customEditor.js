import ClassicEditorBase from '@ckeditor/ckeditor5-editor-classic/src/classiceditor';

import Essentials from '@ckeditor/ckeditor5-essentials/src/essentials';
import Paragraph from '@ckeditor/ckeditor5-paragraph/src/paragraph';
import Bold from '@ckeditor/ckeditor5-basic-styles/src/bold';
import Italic from '@ckeditor/ckeditor5-basic-styles/src/italic';
import Link from '@ckeditor/ckeditor5-link/src/link';
import List from '@ckeditor/ckeditor5-list/src/list';

import Image from '@ckeditor/ckeditor5-image/src/image';
import ImageToolbar from '@ckeditor/ckeditor5-image/src/imagetoolbar';
import ImageUpload from '@ckeditor/ckeditor5-image/src/imageupload';
import Base64UploadAdapter from '@ckeditor/ckeditor5-upload/src/adapters/base64uploadadapter';

export default class CustomEditor extends ClassicEditorBase {}

CustomEditor.builtinPlugins = [
  Essentials,
  Paragraph,
  Bold,
  Italic,
  Link,
  List,
  Image,
  ImageToolbar,
  ImageUpload,
  Base64UploadAdapter,
];

CustomEditor.defaultConfig = {
  toolbar: [
    'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|',
    'imageUpload', '|',
    'undo', 'redo'
  ],
  image: {
    toolbar: ['imageTextAlternative', 'imageStyle:full', 'imageStyle:side']
  }
};
