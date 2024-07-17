
const { test, expect } = require('@playwright/test');

test('Check if Hello Dolly lyrics are displayed on the dashboard', async ({ page }) => {
  // create admin url
  const wpEnv = require('../../.wp-env.json');
  let port = wpEnv.port ? wpEnv.port : 8888;
  try {
    const wpEnvOverride = require('../../.wp-env.override.json');
    Object.assign(wpEnv, wpEnvOverride);
    port = wpEnv.port ? wpEnv.port : 8888;
  } catch (e) {
    // do nothing
  }
  // log in to the admin dashboard
  await page.goto(`http://localhost:${port}/wp-admin/`);
  await page.fill('#user_login', 'admin');
  await page.fill('#user_pass', 'password');
  await page.click('#wp-submit');

  // check if Hello Dolly is displayed
  const helloDolly = await page.innerText('#dolly');
  expect(helloDolly).not.toBe('');

});
