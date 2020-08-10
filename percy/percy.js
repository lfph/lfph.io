const PercyScript = require('@percy/script');
let rooturl = 'https://dev-lfph.pantheonsite.io/';

PercyScript.run(async (page, percySnapshot) => {
  await page.goto(rooturl);
  await page.waitFor('.newsletter');
  await percySnapshot('homepage');

  await page.goto(rooturl + 'projects/');
  await page.waitFor('.newsletter');
  await percySnapshot('projects');

});