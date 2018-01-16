/*!
 * FileInput German Translations
 *
 * This file must be loaded after 'fileinput.js'. Patterns in braces '{}', or
 * any HTML markup tags in the messages must not be converted or translated.
 *
 * @see http://github.com/kartik-v/bootstrap-fileinput
 */
(function ($) {
    "use strict";

    $.fn.fileinput.locales.de = {
        fileSingle: 'Datei',
        filePlural: 'Dateien',
        browseLabel: '上传图片',
        removeLabel: '清除',
        removeTitle: 'Klar ausgewählten Dateien',
        cancelLabel: 'Laden',
        cancelTitle: 'Abbruch laufenden Hochladen',
        uploadLabel: '上传所有',
        uploadTitle: 'Hochladen ausgewählten Dateien',
        msgSizeTooLarge: '文件 "{name}" (<b>{size} KB</b>) 超出最大尺寸限制 <b>{maxSize} KB</b>.请重新选择',
        msgFilesTooLess: '文件个数<b>{n}</b> {files} 少于要求，请重新选择',
        msgFilesTooMany: 'Anzahl der Dateien für den Upload ausgewählt <b>({n})</b> überschreitet maximal zulässige Grenze von <b>{m}</b>. Bitte versuchen Sie Ihr Hochladen!',
        msgFileNotFound: '文件 "{name}" 未找到!',
        msgFileSecured: 'Sicherheitseinschränkungen verhindern Lesen der Datei "{name}".',
        msgFileNotReadable: 'Datei "{name}" ist nicht lesbar.',
        msgFilePreviewAborted: 'Dateivorschau abgebrochen für "{name}".',
        msgFilePreviewError: 'Beim Lesen der Datei "{name}" ein Fehler aufgetreten.',
        msgInvalidFileType: 'Ungültiger Typ für Datei "{name}". Nur "{types}" Dateien werden unterstützt.',
        msgInvalidFileExtension: 'Ungültige Erweiterung für Datei "{name}". Nur "{extensions}" Dateien werden unterstützt.',
        msgValidationError: 'Dateifehler hochladen',
        msgLoading: 'Wird Geladen Datei {index} von {files} &hellip;',
        msgProgress: 'Wird Geladen Datei {index} von {files} - {name} - {percent}% fertiggestellt.',
        msgSelected: '{n} Dateien ausgewählt',
        msgFoldersNotAllowed: 'Drag & Drop Dateien nur! Sprungen {n} gesunken Ordner.',
        dropZoneTitle: '上传描述图片'
    };

    $.extend($.fn.fileinput.defaults, $.fn.fileinput.locales.de);
})(window.jQuery);