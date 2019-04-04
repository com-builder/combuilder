combuilder
=================

A CLI utility for generating Joomla components

[![oclif](https://img.shields.io/badge/cli-oclif-brightgreen.svg)](https://oclif.io)
[![Version](https://img.shields.io/npm/v/@combuilder/combuilder.svg)](https://npmjs.org/package/@combuilder/combuilder)
[![License](https://img.shields.io/npm/l/@combuilder/combuilder.svg)](https://github.com/com-builder/combuilder/blob/master/package.json)
[![Build Status](https://travis-ci.com/com-builder/combuilder.svg?branch=master)](https://travis-ci.com/com-builder/combuilder)

Basic Usage
==================
```
# Install via NPM
$ npm install -g @combuilder/combuilder
# Basic component creation. This component provides to the ablility to
# auto-fill component metadata and file level block comments
$ combuilder create COMPONENTNAME VIEWNAME -g -u http://yoursite.com
> com_COMPONENTNAME successfully created
$ combuilder --help [COMMAND]
> USAGE
  $ combuilder COMMAND
```

Commands
=================
* [`combuilder create [NAME] [VIEW]`](#combuilder-create-name-view)
* [`combuilder help [COMMAND]`](#combuilder-help-command)

There is currently only a create command, for generating a basic
Joomla component. More will be added in the future.

# `combuilder create [name] [view]`

The `create` command builds a Joomla component with the name provided and a
list and item view based on the view name provided. Most options are used to
manipulate component metadata, such as component author, email, URL, etc. The
`-g` option pulls author name and email from your global git configuration. If
any of these options aren't provided they are simply left blank.

The `-t` option is used to specify a template to use. If no template option is
provided, the default template is used.

```
creates a Joomla component based on options provided

USAGE
  $ combuilder create NAME VIEW

ARGUMENTS
  NAME  name of the component you wish to create
  VIEW  name of first view (item and list) to create

OPTIONS
  -a, --author=author          author name for component metadata
  -c, --copyright              the copyright to use in the docblock and xml, defaults to current year and author if not specified
  -d, --createDate=createDate  created date for component metadata, current date is used if this option isn't present
  -e, --email=email            email address for component metadata
  -g, --useGit                 pull meta information from git configuration
  -h, --help                   show CLI help
  -u, --url=url                url for component metadata
  -t, --template=default       the template to use, default is used if none specified

EXAMPLE
  $ combuilder create NAME VIEW
```
# `combuilder help [COMMAND]`

Displays a basic overview of the command requested.
