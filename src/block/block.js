/**
 * BLOCK: Include_Fussball_De_Widgets
 *
 * Registering a dynamic block with Gutenberg.
 * Dynamic block, renders and saves the same content.
 */

//  Import CSS.
import './style.scss';
import './editor.scss';

import icon from './icon';

const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;
const { InspectorControls, PlainText } = wp.editor;
const { Fragment } = wp.element;
const { PanelBody, TextControl } = wp.components;
const { withInstanceId } = wp.compose;

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
registerBlockType( 'ifdw/fubade', {
	title: __( 'Include Fussball.de Widgets', 'include-fussball-de-widgets' ),
	description: __(
		'Showing the fussball.de widget',
		'include-fussball-de-widgets'
	),
	icon: icon.includeFussballDeWidgets,
	category: 'widgets',
	keywords: [ __( 'fubade', 'include-fussball-de-widgets' ) ],

	attributes: {
		api: {
			type: 'string',
		},
		notice: {
			type: 'string',
		},
	},

	edit: withInstanceId(
		( { attributes, className, instanceId, isSelected, setAttributes } ) => {
			const { api, notice } = attributes;
			const inputId = `${ className }-${ instanceId }`;

			const onChangeApi = newApi => {
				setAttributes( { api: newApi } );
				setAttributes( {
					id:
						'fubade_' + ( 32 !== newApi.length ? +new Date() : newApi.slice( -5 ) ),
				} );
			};

			const onChangeNotice = newNotice => {
				setAttributes( { notice: newNotice } );
			};

			return [
				!! isSelected && (
					<InspectorControls key="inspector">
						<PanelBody
							title={ __(
								'Fussball.de Widgets Settings',
								'include-fussball-de-widgets'
							) }
						>
							<TextControl
								label={ __( 'Notice', 'include-fussball-de-widgets' ) }
								value={ notice }
								onChange={ onChangeNotice }
							/>
						</PanelBody>
					</InspectorControls>
				),
				<Fragment key="output">
					<h4 className={ `${ className }-header` }>
						{ __( 'Fussball.de Widget', 'include-fussball-de-widgets' ) }
						{ 'undefined' === typeof notice || '' === notice ?
							'' :
							`: "${ notice }"` }
					</h4>
					<div className={ className }>
						<label htmlFor={ inputId }>
							{ __( 'Api:', 'include-fussball-de-widgets' ) }
						</label>
						<PlainText
							className="input-control"
							id={ inputId }
							value={ api }
							placeholder={ __(
								'Insert API here...',
								'include-fussball-de-widgets'
							) }
							onChange={ onChangeApi }
						/>
					</div>
					{ 'undefined' !== typeof api && 32 === api.length ? (
						<div className={ `${ className }-shortcode` }>
							{ __(
								'The widget should now be able to be displayed in the frontend.',
								'include-fussball-de-widgets'
							) }
						</div>
					) : (
						<div className={ `${ className }-shortcode error` }>
							{ __(
								'!!! The fussball.de API must have a length of exactly 32 characters. !!!',
								'include-fussball-de-widgets'
							) }
						</div>
					) }
				</Fragment>,
			];
		}
	),

	save() {
		// Rendering in PHP
		return null;
	},
} );
