
## Get Framework

Download fresh copy of [Xe Plugin](https://github.com/XeCreators/xe-plugin) and extract it to you development environment. Change folder name to your theme name. e.g: `xurais` or `xu-rais`.


## Install Nodejs

[Nodejs](https://nodejs.org/en/) is a JavaScript runtime built on [Chrome's V8 JavaScript engine](https://v8.dev/).  Install the latest version from their website if you don't have it installed already. You can check `Nodejs` version using the following command.

    node -v

You can check `npm` version using the following command.

    npm -v


## Initialization

1. Navigate to `node_scripts` folder.
2. Open `config.json` with your favorite editor.
3. Change `name` to your theme name. eg: `Xurais` or `Xu Rais` (Capitalized).

        "name": "Xurais",

5. Open command line, navigate to project folder and run this command to install dependencies:

        npm install

3. Now run following command to automatically change `text-domain`, `prefixes` and `DocBlocks` to your theme name.

        npm run init


## Build

Open `config.json` inside `node_scripts` folder and change `build` path to your desired location.

    "build": "E:/Projects/Xe Plugin",

Once you have completed your theme, run the below command to generate a clean copy. `.pot` file will also be generated inside languages folder.

    npm run build

<br>
