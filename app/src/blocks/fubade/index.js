/**
 * BLOCK: Include_Fussball_De_Widgets
 *
 * Registering a dynamic block with Gutenberg.
 * Dynamic block, renders and saves the same content.
 */

import icon from './icon';
import './editor.scss';

const { registerBlockType } = wp.blocks;
const { PanelBody, TextControl, ToggleControl } = wp.components;
const { withInstanceId } = wp.compose;
const { InspectorControls, PlainText } = wp.editor;
const { Fragment } = wp.element;
const { __ } = wp.i18n;

/**
 * Register the dynamic Gutenberg Block for the `Include Fussball.de Widgets`.
 *
 * Registers a new block provided a unique name and an object defining its
 * behavior. Once registered, the block is made editor as an option to any
 * editor interface where blocks are implemented.
 *
 * @link https://wordpress.org/gutenberg/handbook/block-api/
 * @param  {string}   name     Block name.
 * @param  {Object}   settings Block settings.
 * @return {WPBlock}           The block, if it has been successfully
 *                             registered; otherwise `undefined`.
 */
registerBlockType('ifdw/fubade', {
  title: __('Include Fussball.de Widgets', 'include-fussball-de-widgets'),
  description: __('Showing the fussball.de widget', 'include-fussball-de-widgets'),
  category: 'widgets',
  icon,
  keywords: [ __('fubade', 'include-fussball-de-widgets') ],
  attributes: {
    api: { type: 'string' },
    notice: { type: 'string' },
    fullwidth: { type: 'boolean' },
    devtools: { type: 'boolean' }
  },
  edit: withInstanceId(({ attributes, className, instanceId, setAttributes }) => {
    const { api, notice, fullwidth = true, devtools = false } = attributes;
    const inputId = `${ className }-${ instanceId }`;

    return [
      <InspectorControls key="inspector">
        <PanelBody title={ __('Fussball.de Widgets Settings', 'include-fussball-de-widgets') }>
          <TextControl
            label={ __('Notice', 'include-fussball-de-widgets') }
            onChange={ newNotice => {
              setAttributes({ notice: newNotice });
            } }
            value={ notice }
          />
          <ToggleControl
            checked={ fullwidth }
            help={
              fullwidth ?
                __('The widget will be shown in the maximal width.', 'include-fussball-de-widgets') :
                __(
                  'The widget will be shown in the width given from fussball.de' +
                        ' (CSS possible could overwrite this setting).',
                  'include-fussball-de-widgets'
                )
            }
            label={ __('Show in full width', 'include-fussball-de-widgets') }
            onChange={ newFullwidth => {
              setAttributes({ fullwidth: newFullwidth });
            } }
          />
          <ToggleControl
            checked={ devtools }
            help={
              devtools ?
                __(
                  'Some debugging informations will be displayed in the browser console.',
                  'include-fussball-de-widgets'
                ) :
                __('No debugging informations were outputted.', 'include-fussball-de-widgets')
            }
            label={ __('Show some informations for debugging', 'include-fussball-de-widgets') }
            onChange={ isDevTools => {
              setAttributes({ devtools: isDevTools });
            } }
          />
        </PanelBody>
      </InspectorControls>,
      <Fragment key="output">
        <h4 className={ `${ className }-header` }>
          { __('Fussball.de Widget', 'include-fussball-de-widgets') }
          { 'undefined' === typeof notice || '' === notice ? '' : `: "${ notice }"` }
        </h4>
        <div className={ className }>
          <label htmlFor={ inputId }>{ __('Api:', 'include-fussball-de-widgets') }</label>
          <PlainText
            className="input-control"
            id={ inputId }
            onChange={ newApi => {
              setAttributes({ api: newApi });
              setAttributes({
                id: `fubade_${ 32 !== newApi.length ? Number(new Date()) : newApi.slice(-5) }`
              });
            } }
            placeholder={ __('Insert API here...', 'include-fussball-de-widgets') }
            value={ api }
          />
        </div>
        { 'undefined' !== typeof api && 32 === api.length ? (
          <div className={ `${ className }-shortcode` }>
            { __('The widget should now be able to be displayed in the frontend.', 'include-fussball-de-widgets') }
          </div>
        ) : (
          <div className={ `${ className }-shortcode error` }>
            { __(
              '!!! The fussball.de API must have a length of exactly 32 characters. !!!',
              'include-fussball-de-widgets'
            ) }
          </div>
        ) }
      </Fragment>
    ];
  }),

  save() {
    // Rendering in PHP
    return null;
  }
});
