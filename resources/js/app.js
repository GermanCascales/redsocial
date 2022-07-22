require('./bootstrap');

import Alpine from 'alpinejs';

import * as FilePond from 'filepond';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import FilePondPluginFilePoster from 'filepond-plugin-file-poster';
import es_ES from 'filepond/locale/es-es';

window.Alpine = Alpine;
window.FilePond = FilePond;
window.FilePondPluginImagePreview = FilePondPluginImagePreview;
window.FilePondPluginFilePoster = FilePondPluginFilePoster;

Alpine.start();

FilePond.setOptions(es_ES);
