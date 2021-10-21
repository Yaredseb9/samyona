/**
 * Strings internationalization
 *
 * @param {string} str
 * @return {*|string}
 */
export const __ = ( str ) => {
	return wphb.strings[ str ] || '';
};

/**
 * Get a link to a HB screen
 *
 * @param {string} screen Screen slug
 * @return {string} URL
 */
export const getLink = ( screen ) => {
	return wphb.links[ screen ] || '';
};
