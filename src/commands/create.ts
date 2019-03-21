import {Command, flags} from '@oclif/command';
import * as fs from 'fs';
import * as extra from 'fs-extra';

interface Placeholders {
  [key: string]: string
};

export default class Create extends Command {
  static description = 'describe the command here';

  static examples = [
    `$ joomlafy create component view`,
  ];

  static flags = {
    help: flags.help({char: 'h'}),
  };

  /**
   * List of arguments specific to this command
   *
   * @var  {Arg[]}
   */
  static args = [
    {
      name: 'name',
      description: 'name of the component you wish to create',
      required: true,
    },
    {
      name: 'view',
      description: 'name of first view (item and list) to create',
      required: true
    }
  ];

  async run() {
    const { args } = this.parse(Create);
    // Create component with com_ prefix
    const comName = `com_${args.name}`;
    // Create component directory
    fs.mkdirSync(comName);
    // Copy over template to new directory
    extra.copySync('src/template/skeleton', comName);
    // Rename placeholder files in newly created component source
    this.renameFiles(comName, args.name, args.view);

    this.log(fs.readdirSync(comName).join("\n"));
  }

  /**
   * Recursively get rename all files and folders containing placeholder names
   * in newly generated component folder
   *
   * @param   {string}  path  Path to start list operation in
   * @param   {string}  name  Name of component without com_ prefix
   * @param   {string}  view  Name of view to rename
   *
   * @return  {void}
   */
  protected renameFiles(path: string, name: string, view: string): void {
    // Get list of items to start renaming
    let items = fs.readdirSync(path);

    for (let item of items) {
      // Create path to current file or folder for manipulation if needed
      let newPath = `${path}/${item}`;
      // Files and folders containing the following names with be replaced
      const placeholders: Placeholders = {
        '-component_name-': name,
        '-item-': view,
        '-items-': `${view}s`,
      };
      // Loop over each in order to potentially rename
      for (let placeholder in placeholders) {
        // Check if current item matches current placeholder name
        if (item.includes(placeholder)) {
          // Replace placeholder with desired replacement
          const renamed = item.replace(placeholder, placeholders[placeholder]);
          // Use Node JS API to rename file or folder
          fs.renameSync(`${path}/${item}`, `${path}/${renamed}`);
          // Reset newPath part in case current item is a folder. Otherwise
          // recursive operation would not go deeper
          newPath = `${path}/${renamed}`;
        }
      }
      // Check if current item is folder
      if (fs.lstatSync(newPath).isDirectory()) {
        // Recursive call current method to start the next folder operation
        this.renameFiles(newPath, name, view);
      }
    }
  }
}
