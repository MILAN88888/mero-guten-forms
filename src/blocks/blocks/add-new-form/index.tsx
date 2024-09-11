import metadata from "./block.json";
import Edit from "./Edit";
import "./editor.scss";
import Save from "./Save";
import "./style.scss";

export const name = metadata.name;

export const settings = {
  ...metadata,
  edit: Edit,
  save: Save
};
