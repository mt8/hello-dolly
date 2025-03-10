import { defineConfig } from '@playwright/test';
const baseConfig = require( '@wordpress/scripts/config/playwright.config.js' );
const config = defineConfig( {
	...baseConfig,
	testDir: './tests/playwright',
} );
export default config;