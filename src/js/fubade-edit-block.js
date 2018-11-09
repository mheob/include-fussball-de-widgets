const { __ } = wp.i18n;
const { Component, Fragment } = wp.element;
const { PlainText, TextControl } = wp.components;
const { InspectorControls } = wp.editor;

import { FubadeWidgetContainer } from "./fubade-generate-html-output";

/**
 * Code contains the edit action.
 *
 * @since 2.0.0.
 *
 * @export
 * @class edit
 * @extends {Component}
 */
export class edit extends Component {
  /**
   * Creates an instance of edit.
   * @since 2.0.0
   *
   * @param {*} props
   * @memberof edit
   */
  constructor(props) {
    super(...arguments);

    this.state = {
      api: this.props.attributes.api || "",
      notice: this.props.attributes.notice || "",
      id: this.props.attributes.id || this.generateId()
    };
  }

  /**
   * Render the component.
   *
   * @since 2.0.0
   *
   * @returns The rendered output for the editor.
   * @memberof edit
   */
  render() {
    return (
      <Fragment>
        <div className={this.props.className}>
          <div className="field-api">
            <PlainText
              className="input-control"
              id={this.props.className + "_" + this.generateId()}
              value={this.state.api}
              placeholder={__("The API (required)")}
              onChange={api => {
                this.setState({ api });
                this.props.setAttributes({ api });
                this.generateId();
              }}
            />
            {this.state.id.length === 32 ? (
              <FubadeWidgetContainer
                id={this.state.id}
                api={this.state.api}
                notice={this.state.notice}
              />
            ) : (
              ""
            )}
          </div>
        </div>

        <InspectorControls>
          <i className={this.props.className}>
            {__("Customize the widget by using the options below.")}
          </i>

          <TextControl
            label={__("The API (required)")}
            value={this.state.api}
            onChange={api => {
              this.setState({ api });
              this.props.setAttributes({ api });
              this.generateId();
            }}
          />

          <TextControl
            label={__("The Notice")}
            value={this.state.notice}
            onChange={notice => {
              this.setState({ notice });
              this.props.setAttributes({ notice });
              this.generateId();
            }}
          />
        </InspectorControls>
      </Fragment>
    );
  }

  /**
   * Generate the id.
   *
   * @returns The id of the widget.
   * @memberof edit
   */
  generateId() {
    const id = "fubade_" + this.state.api.substr(this.state.api.length - 5);
    this.state.id = id;
    this.props.attributes.id = id;
    return id;
  }
}
