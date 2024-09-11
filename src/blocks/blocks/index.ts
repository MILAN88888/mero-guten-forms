import { registerBlockType } from "@wordpress/blocks";
import { applyFilters } from "@wordpress/hooks";
import * as addnewform from "./add-new-form";

let blocks = [addnewform];

blocks = applyFilters("mgf.blocks", blocks) as typeof blocks;

/**
 * The function "registerBlocks" iterates over an array of blocks and calls the
 * "register" method on each block.
 */
export const registerBlocks = () => {
  for (const block of blocks) {
    const settings = applyFilters("mgf.block.metadata", block.settings) as any;
    settings.edit = applyFilters("mgf.block.edit", settings.edit, settings);
    registerBlockType(block.name, settings);
  }
};

export default registerBlocks;
