require('./bootstrap');

import Alpine from 'alpinejs';
import * as FilePond from 'filepond';
import es_ES from 'filepond/locale/es-es';

window.Alpine = Alpine;
window.FilePond = FilePond;

Alpine.start();

FilePond.setOptions(es_ES);
