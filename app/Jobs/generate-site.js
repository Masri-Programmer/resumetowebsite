// generate-site.js
import { renderToString } from 'vue/server-renderer';
import ResumeComponent from './Resume.vue';

// Data would be passed to this script from your Laravel job
const userData = JSON.parse(process.argv[2]);

const appHtml = await renderToString(createApp(ResumeComponent, { parsed_data: userData }));

// Inject the rendered HTML into a full HTML template
const finalHtml = `<!DOCTYPE html>...<body><div id="app">${appHtml}</div></body>...`;

// Save the file
fs.writeFileSync(`./dist/${userData.username}/index.html`, finalHtml);
