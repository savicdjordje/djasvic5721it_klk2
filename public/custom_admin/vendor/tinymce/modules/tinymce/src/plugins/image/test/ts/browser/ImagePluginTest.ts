import { Cursors } from '@ephox/agar';
import { describe, it } from '@ephox/bedrock-client';
import { TinyAssertions, TinyHooks, TinySelections, TinyUiActions } from '@ephox/wrap-mcagar';

import Editor from 'tinymce/core/api/Editor';
import Plugin from 'tinymce/plugins/image/Plugin';

import { advancedTabLabels, assertInputValue, fillActiveDialog, ImageDialogData } from '../module/Helpers';

describe('browser.tinymce.plugins.image.ImagePluginTest', () => {
  const hook = TinyHooks.bddSetupLight<Editor>({
    plugins: 'image',
    toolbar: 'image',
    indent: false,
    base_url: '/project/tinymce/js/tinymce',
    setup: (editor: Editor) => {
      editor.ui.registry.addContextToolbar('test-image', {
        predicate: (node) => node.nodeName.toLowerCase() === 'img',
        items: 'image'
      });
    }
  }, [ Plugin ], true);

  const pInitAndOpenDialog = async (editor: Editor, content: string, cursorPos: Cursors.CursorSpec | Cursors.RangeSpec) => {
    editor.options.set('image_advtab', true);
    editor.options.set('image_dimensions', false);
    editor.setContent(content);
    TinySelections.setSelectionFrom(editor, cursorPos);
    editor.execCommand('mceImage');
    await TinyUiActions.pWaitForDialog(editor);
  };

  const pCreateTestWithContent = async (editor: Editor, content: string, cursorPos: Cursors.CursorSpec | Cursors.RangeSpec, data: Partial<ImageDialogData>, expectedContent: string) => {
    await pInitAndOpenDialog(editor, content, cursorPos);
    fillActiveDialog(data, true);
    TinyUiActions.submitDialog(editor);
    TinyAssertions.assertContent(editor, expectedContent);
  };

  const pCreateTestOnEmptyEditor = (editor: Editor, data: Partial<ImageDialogData>, expectedContent: string) =>
    pCreateTestWithContent(editor, '', { element: [ 0 ], offset: 0 }, data, expectedContent);

  const pCreateTestValidatingAdvancedTab = async (editor: Editor, style: string, assertion: () => void) => {
    await pInitAndOpenDialog(editor, `<img style="${style}" src="src" alt="alt">`, { start: { element: [ 0 ], offset: 0 }, finish: { element: [ 0 ], offset: 1 }});
    TinyUiActions.clickOnUi(editor, '.tox-tab:contains("Advanced")');
    assertion();
    TinyUiActions.submitDialog(editor);
  };

  it('TBA: Advanced image dialog margin space options on empty editor', () =>
    pCreateTestOnEmptyEditor(
      hook.editor(),
      {
        alt: 'alt',
        hspace: '10',
        src: {
          value: 'src'
        },
        vspace: '10'
      },
      '<p><img style="margin: 10px;" src="src" alt="alt"></p>'
    )
  );

  it('TBA: Advanced image dialog border style only options on empty editor', () =>
    pCreateTestOnEmptyEditor(
      hook.editor(),
      {
        alt: 'alt',
        src: {
          value: 'src'
        },
        border: '10px',
        borderstyle: 'solid'
      },
      '<p><img style="border-width: 10px; border-style: solid;" src="src" alt="alt"></p>'
    )
  );

  it('TBA: Advanced image dialog border style options on empty editor', () =>
    pCreateTestOnEmptyEditor(
      hook.editor(),
      {
        alt: 'alt',
        border: '10',
        src: {
          value: 'src'
        },
      },
      '<p><img style="border-width: 10px;" src="src" alt="alt"></p>'
    )
  );

  it('TBA: Advanced image dialog margin style options on empty editor', () =>
    pCreateTestOnEmptyEditor(
      hook.editor(),
      {
        alt: 'alt',
        hspace: '10',
        src: {
          value: 'src'
        },
        vspace: '10'
      },
      '<p><img style="margin: 10px;" src="src" alt="alt"></p>'
    )
  );

  it('TBA: Advanced image dialog border option on editor with content', () =>
    pCreateTestWithContent(
      hook.editor(),
      '<p>a</p>',
      {
        element: [ 0 ],
        offset: 1
      },
      {
        alt: 'alt',
        border: '10',
        borderstyle: 'dashed',
        src: {
          value: 'src'
        }
      },
      '<p>a<img style="border-width: 10px; border-style: dashed;" src="src" alt="alt"></p>'
    )
  );

  it('TBA: Advanced image dialog non-shorthand horizontal margin style change test', () =>
    pCreateTestValidatingAdvancedTab(
      hook.editor(),
      'margin-left: 15px; margin-right: 15px;',
      () => {
        assertInputValue(advancedTabLabels.vspace, '');
        assertInputValue(advancedTabLabels.hspace, '15');
      }
    )
  );

  it('TBA: Advanced image dialog non-shorthand vertical margin style change test', () =>
    pCreateTestValidatingAdvancedTab(
      hook.editor(),
      'margin-top: 15px; margin-bottom: 15px;',
      () => {
        assertInputValue(advancedTabLabels.vspace, '15');
        assertInputValue(advancedTabLabels.hspace, '');
      }
    )
  );

  it('TBA: Advanced image dialog shorthand margin 1 value style change test', () =>
    pCreateTestValidatingAdvancedTab(
      hook.editor(),
      'margin: 5px;',
      () => {
        assertInputValue(advancedTabLabels.vspace, '5');
        assertInputValue(advancedTabLabels.hspace, '5');
      }
    )
  );

  it('TBA: Advanced image dialog shorthand margin 2 value style change test', () =>
    pCreateTestValidatingAdvancedTab(
      hook.editor(),
      'margin: 5px 10px;',
      () => {
        assertInputValue(advancedTabLabels.vspace, '5');
        assertInputValue(advancedTabLabels.hspace, '10');
      }
    )
  );

  it('TBA: Advanced image dialog shorthand margin 3 value style change test', () =>
    pCreateTestValidatingAdvancedTab(
      hook.editor(),
      'margin: 5px 10px 15px;',
      () => {
        assertInputValue(advancedTabLabels.vspace, '');
        assertInputValue(advancedTabLabels.hspace, '10');
      }
    )
  );

  it('TBA: Advanced image dialog shorthand margin 4 value style change test', () =>
    pCreateTestValidatingAdvancedTab(
      hook.editor(),
      'margin: 5px 10px 15px 20px;',
      () => {
        assertInputValue(advancedTabLabels.vspace, '');
        assertInputValue(advancedTabLabels.hspace, '');
      }
    )
  );

  it('TBA: Advanced image dialog shorthand margin 4 value style with single value override change test', () =>
    pCreateTestValidatingAdvancedTab(
      hook.editor(),
      'margin: 5px 10px 15px 20px; margin-top: 15px;',
      () => {
        assertInputValue(advancedTabLabels.vspace, '15');
        assertInputValue(advancedTabLabels.hspace, '');
      }
    )
  );

  it('TINY-3463: Ensure initial toolbar button state shows correctly', async () => {
    const editor = hook.editor();
    editor.setContent('<p>Content</p><p><img src="image.png"></p>');

    TinySelections.setCursor(editor, [ 0, 0 ], 4);
    await TinyUiActions.pWaitForUi(editor, '.tox-tbtn[data-mce-name="image"]:not(.tox-tbtn--enabled)');

    TinySelections.setSelection(editor, [ 1 ], 0, [ 1 ], 1);
    await TinyUiActions.pWaitForUi(editor, '.tox-tbtn.tox-tbtn--enabled[data-mce-name="image"]');
    await TinyUiActions.pWaitForUi(editor, '.tox-pop .tox-tbtn.tox-tbtn--enabled[data-mce-name="image"]');
  });
});
