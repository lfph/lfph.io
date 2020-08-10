const PercyScript = require('@percy/script');
let rooturl = process.argv[2];
let delay = 10000;

PercyScript.run(async (page, percySnapshot) => {
  await page.goto(rooturl);
  await page.waitFor(delay);
  await percySnapshot('homepage');

  await page.goto(rooturl + 'projects/');
  await page.waitFor(delay);
  await percySnapshot('projects');

  await page.goto(rooturl + 'join/faq/#what-is-upstream-what-is-a-fork-what-is-a-maintainer');
  await page.waitFor(delay);
  await percySnapshot('faq at anchor');

  await page.goto(rooturl + 'community/webinars/');
  await page.waitFor(delay);
  await percySnapshot('webinars');

  await page.goto(rooturl + 'blog/');
  await page.waitFor(delay);
  await percySnapshot('blog');

  await page.goto(rooturl + 'about/staff/');
  await page.waitFor(delay);
  await percySnapshot('staff');

  await page.goto(rooturl + 'about/contact/');
  await page.waitFor(delay);
  await percySnapshot('contact');
});