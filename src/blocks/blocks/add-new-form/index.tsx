import metadata from "./block.json";
import Edit from "./Edit";
import Save from "./Save";

export const name = metadata.name;

export const settings = {
  ...metadata,
  edit: Edit,
  save: Save
};
