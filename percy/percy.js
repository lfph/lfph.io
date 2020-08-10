const PercyScript = require('@percy/script');
let rooturl = process.argv[2];

PercyScript.run(async (page, percySnapshot) => {
  await page.goto(rooturl);
  await page.waitFor(1000);
  await percySnapshot('homepage');

  await page.goto(rooturl + 'projects/');
  await page.waitFor(1000);
  await percySnapshot('projects');

  await page.goto(rooturl + 'join/faq/#what-is-upstream-what-is-a-fork-what-is-a-maintainer');
  await page.waitFor(1000);
  await percySnapshot('faq at anchor');

  await page.goto(rooturl + 'community/webinars/');
  await page.waitFor(1000);
  await percySnapshot('webinars');

  await page.goto(rooturl + 'blog/');
  await page.waitFor(1000);
  await percySnapshot('blog');

  await page.goto(rooturl + 'about/staff/');
  await page.waitFor(1000);
  await percySnapshot('staff');

  await page.goto(rooturl + 'about/contact/');
  await page.waitFor(1000);
  await percySnapshot('contact');
});