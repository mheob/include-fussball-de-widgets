const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;

import { edit } from "./fubade-edit-block";
import { generateHtmlOutput } from "./fubade-generate-html-output";

/**
 * Register the gutenberg block inside the embed category.
 *
 * @since 2.0.0.
 */
registerBlockType("include-fussball-de-widgets/fubade", {
  title: __("Include Fussball.de Widgets"),
  description: __("Block showing the fussball.de widget"),
  category: "widgets",
  icon: "sos",
  keywords: [__("soccer"), __("fubade")],
  attributes: {
    id: {
      type: "string"
    },
    api: {
      type: "string"
    },
    notice: {
      type: "string"
    }
  },
  edit,
  save: props => {
    return generateHtmlOutput(
      props.attributes.id,
      props.attributes.api,
      props.attributes.notice
    );
  }
});
