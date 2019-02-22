# Component Builder

`npm` CLI, built with `oclif`, utility for creating and managing Joomla components.

## Proposed functionality

* Folder for component template with placeholders for easily finding and replacing section names
* Some sort of database or caching system for adding and modifying views
* A convenient way to pass arguments, possibly an option to pass a JSON file for complex component creation
* Eventually a way to generate modules, plugins, libraries, and packages as well

## Potential Libraries Needed

[oclif](https://github.com/oclif/oclif)

## Potential Command Structure

### Component creation
`joomlafy create component-name`

### Adding section
`joomlafy add sectionName column^1..column^n`

### Adding column
`joomlafy add-column columnName -t type`

### Removing section
`joomlafy remove sectionName`

### Removing column
`joomlafy remove-column columnName`