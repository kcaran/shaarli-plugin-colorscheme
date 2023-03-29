# Shaarli Colorscheme plugin

**Colorscheme** is a plugin for [Shaarli](https://github.com/shaarli/shaarli)
that displays a color in #xxyyzz format as an inline sample block.

Example with Shaarli Shirley theme:

![Shaarli Colorscheme plugin preview](https://raw.githubusercontent.com/kcaran/shaarli-plugin-colorscheme/master/colorscheme_preview.png)

## Installation
### Via Git

Run the following command from the plugins folder
of your Shaarli installation:

```sh
$ cd shaarli/plugins
$ git clone https://github.com/kcaran/shaarli-plugin-colorscheme colorscheme
```

It'll create the `colorscheme` folder.

### Manually

Create the folder plugins/colorscheme in your Shaarli installation. Download the ZIP file of this repository and copy all files in the newly created folder.

## Activation
If your Shaarli installation is recent enough to have the plugin administration page, you just need to go to the plugin administration page, check `colorscheme` and save.

## Update
If you installed through Git, run the following command from within this plugin's folder `plugins/colorscheme`:

```shell
git pull
```

Otherwise, download the ZIP file again from Github and override the existing files with the new ones.
