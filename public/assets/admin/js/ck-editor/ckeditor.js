// ckeditor.js

import {ClassicEditor as ClassicEditorBase} from '@ckeditor/ckeditor5-editor-classic';
import {Essentials} from '@ckeditor/ckeditor5-essentials';
import {Autoformat} from '@ckeditor/ckeditor5-autoformat';
import {Bold, Italic, Strikethrough, Subscript, Superscript, Underline} from '@ckeditor/ckeditor5-basic-styles';
import {BlockQuote} from '@ckeditor/ckeditor5-block-quote';
import {Heading} from '@ckeditor/ckeditor5-heading';
import {Link, LinkImage} from '@ckeditor/ckeditor5-link';
import {List, TodoList} from '@ckeditor/ckeditor5-list';
import {Paragraph} from '@ckeditor/ckeditor5-paragraph';
import {HorizontalLine} from "@ckeditor/ckeditor5-horizontal-line";
import {FontBackgroundColor, FontColor, FontFamily} from "@ckeditor/ckeditor5-font";
import {ImageBlockEditing, ImageEditing, ImageInsert, ImageResize} from "@ckeditor/ckeditor5-image";
import {MediaEmbed} from "@ckeditor/ckeditor5-media-embed";
import {Alignment} from "@ckeditor/ckeditor5-alignment";
import {PageBreak} from "@ckeditor/ckeditor5-page-break";
import {RemoveFormat} from "@ckeditor/ckeditor5-remove-format";
import {SpecialCharacters} from "@ckeditor/ckeditor5-special-characters";
import {Highlight} from "@ckeditor/ckeditor5-highlight";
import {Indent} from "@ckeditor/ckeditor5-indent";
import {Table} from "@ckeditor/ckeditor5-table";
import {FindAndReplace} from "@ckeditor/ckeditor5-find-and-replace";
import {SourceEditing} from "@ckeditor/ckeditor5-source-editing";
import {SimpleUploadAdapter} from "@ckeditor/ckeditor5-upload";
import {HtmlEmbed} from "@ckeditor/ckeditor5-html-embed";
import "./fa.js";
import "@ckeditor/ckeditor5-alignment/build/translations/fa.js";
import "@ckeditor/ckeditor5-font/build/translations/fa.js";
import "@ckeditor/ckeditor5-basic-styles/build/translations/fa.js";
import "@ckeditor/ckeditor5-remove-format/build/translations/fa.js";
import "@ckeditor/ckeditor5-highlight/build/translations/fa.js";
import "@ckeditor/ckeditor5-block-quote/build/translations/fa.js";
import "@ckeditor/ckeditor5-page-break/build/translations/fa.js";
import "@ckeditor/ckeditor5-horizontal-line/build/translations/fa.js";
import "@ckeditor/ckeditor5-find-and-replace/build/translations/fa.js";
import "@ckeditor/ckeditor5-special-characters/build/translations/fa.js";
import "@ckeditor/ckeditor5-html-embed/build/translations/fa.js";

export default class ClassicEditor extends ClassicEditorBase {
}

ClassicEditor.builtinPlugins = [
	Essentials,
	Autoformat,
	Bold,
	Underline,
	Italic,
	BlockQuote,
	Heading,
	Link,
	List,
	Paragraph,
	HorizontalLine,
	FontBackgroundColor,
	FontColor,
	FontFamily,
	LinkImage,
	ImageInsert,
	ImageResize,
	MediaEmbed,
	ImageEditing,
	ImageBlockEditing,
	Alignment,
	PageBreak,
	Strikethrough,
	Subscript,
	Superscript,
	RemoveFormat,
	SpecialCharacters,
	Highlight,
	TodoList,
	Indent,
	Table,
	FindAndReplace,
	SourceEditing,
	SimpleUploadAdapter,
	HtmlEmbed
];

ClassicEditor.defaultConfig = {
	toolbar: {
		items: [
			"heading", "|", "alignment", "pageBreak", "horizontalLine", "|", "fontBackgroundColor", "fontColor", "fontFamily", "|", "link", "imageInsert", "mediaEmbed", "htmlEmbed", "|", "bold", "underline", "italic", "strikethrough", "subscript", "superscript", "|", "removeFormat", "highlight", "bulletedList", "numberedList", "todoList", "outdent", "indent", "|", "blockQuote", "insertTable", "|", "findAndReplace", "selectAll", "|", "sourceEditing", "undo", "redo"
		]
	},
	language: 'fa',
};
