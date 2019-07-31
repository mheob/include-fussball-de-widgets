/**
 * BLOCK: Include_Fussball_De_Widgets
 *
 * Registering a dynamic block with Gutenberg.
 * Dynamic block, renders and saves the same content.
 */

import icon from './icon';

const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;
const { InspectorControls, PlainText } = wp.editor;
const { Fragment } = wp.element;
const { PanelBody, TextControl, ToggleControl } = wp.components;
const { withInstanceId } = wp.compose;

const IFDW_DOMAIN = 'include-fussball-de-widgets';

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
  title: __('Include Fussball.de Widgets', IFDW_DOMAIN),
  description: __('Showing the fussball.de widget', IFDW_DOMAIN),
  icon,
  category: 'widgets',
  keywords: [ __('fubade', IFDW_DOMAIN) ],

  attributes: {
    api: { type: 'string' },
    notice: { type: 'string' },
    fullwidth: { type: 'boolean' },
    devtools: { type: 'boolean' }
  },

  edit: withInstanceId(({ attributes, className, instanceId, isSelected, setAttributes }) => {
    const { api, notice, fullwidth = true, devtools = true } = attributes;
    const inputId = `${ className }-${ instanceId }`;

    return [
      Boolean(isSelected) && (
        <InspectorControls key="inspector">
          <PanelBody title={ __('Fussball.de Widgets Settings', IFDW_DOMAIN) }>
            <TextControl
              label={ __('Notice', IFDW_DOMAIN) }
              onChange={ newNotice => {
                setAttributes({ notice: newNotice });
              } }
              value={ notice }
            />
            <ToggleControl
              checked={ fullwidth }
              help={
                fullwidth ?
                  __('The widget will be shown in the maximal width.', IFDW_DOMAIN) :
                  __(
                    'The widget will be shown in the width given from fussball.de' +
                        ' (CSS possible could overwrite this setting).',
                    IFDW_DOMAIN
                  )
              }
              label={ __('Show in full width', IFDW_DOMAIN) }
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
                    IFDW_DOMAIN
                  ) :
                  __('No debugging informations were outputted.', IFDW_DOMAIN)
              }
              label={ __('Show some informations for debugging', IFDW_DOMAIN) }
              onChange={ isDevTools => {
                setAttributes({ devtools: isDevTools });
              } }
            />
          </PanelBody>
        </InspectorControls>
      ),
      <Fragment key="output">
        <h4 className={ `${ className }-header` }>
          { __('Fussball.de Widget', IFDW_DOMAIN) }
          { 'undefined' === typeof notice || '' === notice ? '' : `: "${ notice }"` }
        </h4>
        <div className={ className }>
          <label htmlFor={ inputId }>{ __('Api:', IFDW_DOMAIN) }</label>
          <PlainText
            className="input-control"
            id={ inputId }
            onChange={ newApi => {
              setAttributes({ api: newApi });
              setAttributes({
                id: `fubade_${ 32 !== newApi.length ? Number(new Date()) : newApi.slice(-5) }`
              });
            } }
            placeholder={ __('Insert API here...', IFDW_DOMAIN) }
            value={ api }
          />
        </div>
        { 'undefined' !== typeof api && 32 === api.length ? (
          <div className={ `${ className }-shortcode` }>
            { __('The widget should now be able to be displayed in the frontend.', IFDW_DOMAIN) }
          </div>
        ) : (
          <div className={ `${ className }-shortcode error` }>
            { __(
              '!!! The fussball.de API must have a length of exactly 32 characters. !!!',
              IFDW_DOMAIN
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
