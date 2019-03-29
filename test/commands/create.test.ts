import {expect, test} from '@oclif/test';
import { lstatSync, readdirSync, rmdirSync, unlinkSync } from 'fs';
import { resolve } from 'path';

// This is the component name we will be using through out these tests
const comName = 'foo';

/**
 * Recursively deletes files in directory provided. Used for cleaning up after
 * unit tests
 *
 * @param   {string}  path  Path to remove
 *
 * @return  {void}
 */
function clean(path: string): void {
  // Get list of items inside current directory
  const items = readdirSync(path);

  for (let item of items) {
    // Build absolute path to current item
    let next = `${path}/${item}`;
    // Delete item if it is a file
    if (lstatSync(next).isFile()) {
      unlinkSync(next);
    }
    // Move into item if it is a directory
    else if (lstatSync(next).isDirectory()) {
      clean(next);
    }
  }
  rmdirSync(path);
}

describe('create', () => {
  test.stdout().command(['create', comName, 'bar']).it('successfully runs create command', (ctx) => {
    expect(ctx.stdout).to.contain(`com_${comName}`);
  });

  // Delete component directory after test is run
  afterEach(() => {
    const path = resolve(`com_${comName}`);
    clean(path);
  });
});
