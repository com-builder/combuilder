import {Command, flags} from '@oclif/command'
import * as fs from 'fs';
import * as extra from 'fs-extra';

interface Placeholders {
  [key: string]: string
};

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

    view: flags.string({
      char: 'i',
      description: 'name of first view (item and list) to create',
      required: true
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

    this.renameFiles(comName, flags.name, flags.view);

    this.log(fs.readdirSync(comName).join("\n"));
  }

  protected renameFiles(path: string, name: string, view: string): void {
    let items = fs.readdirSync(path);
    for (let item of items) {
      let newPath = `${path}/${item}`;
      const placeholders: Placeholders = {
        '-component_name-': name,
        '-item-': view,
        '-items-': `${view}s`,
      };
      for (let placeholder in placeholders) {
        if (item.includes(placeholder)) {
          const renamed = item.replace(placeholder, placeholders[placeholder]);
          fs.renameSync(`${path}/${item}`, `${path}/${renamed}`);
          newPath = `${path}/${renamed}`;
        }
      }
      if (fs.lstatSync(newPath).isDirectory()) {
        this.renameFiles(newPath, name, view);
      }
    }
  }
}
