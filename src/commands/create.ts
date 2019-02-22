import {Command, flags} from '@oclif/command'
import * as fs from 'fs';
import * as extra from 'fs-extra';

export default class Create extends Command {
  static description = 'describe the command here';

  static examples = [
    `$ joomlafy create
hello world from ./src/hello.ts!
`,
  ];

  static flags = {
    help: flags.help({char: 'h'}),
    // flag with a value (-n, --name=VALUE)
    name: flags.string({
      char: 'n',
      description: 'name of the component you wish to create',
      required: true,
    }),
    // flag with no value (-f, --force)
    force: flags.boolean({char: 'f'}),
  };

  static args = [{name: 'file'}];

  async run() {
    const {args, flags} = this.parse(Create);
    // Create component with com_ prefix
    const comName = `com_${flags.name}`;
    // Create component directory
    fs.mkdirSync(comName);
    // Copy over template to new directory
    extra.copySync('src/template/skeleton', comName);
    this.log(fs.readdirSync('src/template/skeleton').join("\n"));
  }
}
