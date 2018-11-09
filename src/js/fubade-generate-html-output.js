const { __ } = wp.i18n;
const { Component } = wp.element;

/**
 * Generate the html output for the Include Fussball.de Widgets.
 *
 * @since 2.0.0
 *
 * @param {} param
 */
export const generateHtmlOutput = (id, api, notice) => {
  let output;
  output = `<!-- PLUGIN START Include Fussball.de Widgets -->`;
  output += `<div id=${id} class="include-fussball-de-widgets">... `;
  output += __(
    `the fussball.de widget with the description <i>${notice}</i> is currently loading`
  );
  output += ` ...</div>`;
  output += `<script type="text/javascript">$( document ).ready(() => {new FussballdeWidgetAPI().showWidget("${id}", "${api}");});</script>`;
  output += `<!-- PLUGIN END Include Fussball.de Widgets -->`;

  return output;
};

export class FubadeWidgetContainer extends Component {
  render() {
    return generateHtmlOutput(this.id, this.notice);
  }
}

export default FubadeWidgetContainer;
