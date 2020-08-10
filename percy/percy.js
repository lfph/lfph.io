const PercyScript = require('@percy/script');
let rooturl = 'https://dev-lfph.pantheonsite.io/';

PercyScript.run(async (page, percySnapshot) => {
  await page.goto(rooturl);
  // ensure the page has loaded before capturing a snapshot
  await page.waitFor('.newsletter');
  await percySnapshot('homepage');
});