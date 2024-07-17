
const { test, expect } = require( '@wordpress/e2e-test-utils-playwright' );

test.describe( 'Hello Dolly', () => {
	test( 'Check if Hello Dolly lyrics are displayed on the dashboard', async ( {
		page,
		admin,
	} ) => {
		await admin.visitAdminPage( '/' );
    const helloDolly = await page.innerText('#dolly');
    expect(helloDolly).not.toBe('');  
	} );
} );
