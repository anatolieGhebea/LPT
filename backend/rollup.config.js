import svelte from 'rollup-plugin-svelte';
import resolve from 'rollup-plugin-node-resolve';
import commonjs from 'rollup-plugin-commonjs';
// import livereload from 'rollup-plugin-livereload';
import { terser } from 'rollup-plugin-terser';

const production = !process.env.ROLLUP_WATCH;

//
let compileList = [
	{
		fileName: 'ddtedit',
		folder: 'ddt',
	},
	{
		fileName: 'ddtcreate',
		folder: 'ddt',
	},
	{
		fileName: 'cassa',
		folder: 'cassa',
	},
	{
		fileName: 'orderPanel',
		folder: 'ordini',
	},
	{
		fileName: 'ultimiClientiInseriti',
		folder: 'homepage',
	},
	{
		fileName: 'ultimiOrdiniArrivati',
		folder: 'homepage',
	},
	{
		fileName: 'loadunload',
		folder: 'caricoscarico',
	},
	{
		fileName: 'abbonamenti',
		folder: 'abbonamenti'
	},
	{
		fileName: 'chartBox',
		folder: 'homepage'
	},
	{
		fileName: 'manageProduct',
		folder: 'prodotti'
	},
	{
		fileName: 'producerAutocomplete',
		folder: 'formPluggableComponents/producer'
	},
	{
		fileName: 'authorAutocomplete',
		folder: 'formPluggableComponents/author'
	}
];


// compile just the page that's in development
// change accordingly
let workingFile = [
	{
		// fileName: 'chartBox',
		// folder: 'homepage'
		fileName: 'nuovoProdotto',
		folder: 'prodotti'
	}
];

function getConfig( fList ){
	let list = [];
	fList.forEach( f => {
		let out = {
			input: 'resources/assets/js/svelte/'+f.folder+'/'+f.fileName+'.js',
			output: {
				sourcemap: true,
				format: 'iife',
				name: f.fileName,
				file: 'public/js/'+f.folder+'/'+f.fileName+'.js'
			},
			plugins: [
				svelte({
					// enable run-time checks when not in production
					dev: !production,
					// we'll extract any component CSS out into
					// a separate file — better for performance
					css: css => {
						css.write('public/css/'+f.folder+'/'+f.fileName+'.css');
					}
				}),
		
				// If you have external dependencies installed from
				// npm, you'll most likely need these plugins. In
				// some cases you'll need additional configuration —
				// consult the documentation for details:
				// https://github.com/rollup/rollup-plugin-commonjs
				resolve({
					browser: true,
					// dedupe: importee => importee === 'svelte' || importee.startsWith('svelte/'),
				}),
				commonjs(),
		
				// Watch the `public` directory and refresh the
				// browser on changes when not in production
				// !production && livereload('public'),
		
				// If we're building for production (npm run build
				// instead of npm run dev), minify
				production && terser()
			],
			watch: { clearScreen: false }
		}
	
		list.push(out);
	});

	return list;
}

let compileAll = true;
if(production)
	compileAll = true;

let config = [];
if(compileAll){
	config = getConfig( compileList );
}else{
	config = getConfig( workingFile );
}

export default config;