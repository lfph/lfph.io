const PercyScript = require('@percy/script');

PercyScript.run(async (page, percySnapshot) => {
  await page.goto('https://dev-lfph.pantheonsite.io/');
  // ensure the page has loaded before capturing a snapshot
  await page.waitFor('.newsletter');
  await percySnapshot('homepage');
});