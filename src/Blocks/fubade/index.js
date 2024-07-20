/**
 * BLOCK: Include_Fussball_De_Widgets
 *
 * Registering a dynamic block with Gutenberg.
 * Dynamic block, renders and saves the same content.
 */

import icon from './icon.js';

import './editor.scss';

const { registerBlockType } = wp.blocks;
const { PanelBody, TextControl, ToggleControl } = wp.components;
const { withInstanceId } = wp.compose;
const { InspectorControls, PlainText } = wp.blockEditor;
const { Fragment } = wp.element;
const { __ } = wp.i18n;

/**
 * Register the dynamic Gutenberg Block for the `Include Fussball.de Widgets`.
 *
 * Registers a new block provided a unique name and an object defining its behavior. Once registered,
 * the block is made editor as an option to any editor interface where blocks are implemented.
 *
 * @see https://wordpress.org/gutenberg/handbook/block-api/
 * @param  {string}   name     Block name.
 * @param  {object}   settings Block settings.
 * @returns {Element}          The block, if it has been successfully
 *                             registered; otherwise `undefined`.
 */
registerBlockType('ifdw/fubade', {
	attributes: {
		api: { type: 'string' },
		classes: { type: 'string' },
		devtools: { type: 'boolean' },
		fullWidth: { type: 'boolean' },
		id: { type: 'string' },
		notice: { type: 'string' },
	},
	category: 'widgets',
	description: __('Showing the fussball.de widget', 'include-fussball-de-widgets'),
	edit: withInstanceId(({ attributes, className, instanceId, setAttributes }) => {
		const { api = '', classes = '', devtools = false, fullWidth = true, notice = '' } = attributes;
		const inputId = `${className}-${instanceId}`;
		const apiLength = 32;

		if (Object.entries(attributes).length === 0) {
			setAttributes({
				api: '',
				classes: '',
				devtools: false,
				fullWidth: true,
				id: '',
				notice: '',
			});
		}

		return [
			<InspectorControls key="inspector">
				<PanelBody title={__('Fussball.de Widgets Settings', 'include-fussball-de-widgets')}>
					<TextControl
						onChange={newClasses => {
							setAttributes({ classes: newClasses });
						}}
						label={__('CSS-Classes', 'include-fussball-de-widgets')}
						value={classes}
					/>

					<TextControl
						onChange={newNotice => {
							setAttributes({ notice: newNotice });
						}}
						label={__('Notice', 'include-fussball-de-widgets')}
						value={notice}
					/>

					<ToggleControl
						help={
							fullWidth
								? __(
										'The widget will be shown in the maximal width.',
										'include-fussball-de-widgets',
									)
								: __(
										'The widget will be shown in the width given from fussball.de' +
											'(CSS possible could overwrite this setting).',
										'include-fussball-de-widgets',
									)
						}
						onChange={newFullWidth => {
							setAttributes({ fullWidth: newFullWidth });
						}}
						checked={fullWidth}
						label={__('Show in full width', 'include-fussball-de-widgets')}
					/>

					<ToggleControl
						help={
							devtools
								? __(
										'Debugging information will be displayed in the browser console.',
										'include-fussball-de-widgets',
									)
								: __('No debugging information were outputted.', 'include-fussball-de-widgets')
						}
						onChange={isDevTools => {
							setAttributes({ devtools: isDevTools });
						}}
						checked={devtools}
						label={__('Show some information for debugging', 'include-fussball-de-widgets')}
					/>
				</PanelBody>
			</InspectorControls>,

			<Fragment key="output">
				<h4 className={`${className}-header`}>
					{__('Fussball.de Widget', 'include-fussball-de-widgets')}
					{typeof notice === 'undefined' || notice === '' ? '' : `: "${notice}"`}
				</h4>

				<div className={className}>
					<label htmlFor={inputId}>{__('Api:', 'include-fussball-de-widgets')}</label>

					<PlainText
						onChange={newApi => {
							setAttributes({
								api: newApi,
								id: `fubade-${instanceId}-${
									apiLength === newApi.length ? newApi.slice(-5) : `ERROR_${Number(new Date())}`
								}`,
							});
						}}
						className="input-control"
						id={inputId}
						placeholder={__('Insert API here...', 'include-fussball-de-widgets')}
						value={api}
					/>
				</div>

				{typeof api !== 'undefined' && apiLength === api.length ? (
					<div className={`${className}-shortcode`}>
						{__(
							'The widget should now be able to be displayed in the frontend.',
							'include-fussball-de-widgets',
						)}
					</div>
				) : (
					<div className={`${className}-shortcode error`}>
						{__(
							'!!! The fussball.de API must have a length of exactly 32 characters. !!!',
							'include-fussball-de-widgets',
						)}
					</div>
				)}
			</Fragment>,
		];
	}),
	icon,
	keywords: [__('fubade', 'include-fussball-de-widgets')],
	save() {
		// Rendering in PHP
		return null;
	},

	title: __('Include Fussball.de Widgets', 'include-fussball-de-widgets'),
});
