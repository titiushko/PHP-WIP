// Title: tigra tables
// Description: See the demo at url
// URL: http://www.softcomplex.com/products/tigra_tables/
// Version: 1.0
// Date: 03-04-2002 (mm-dd-yyyy)
// Notes: Permission given to use this script in any kind of applications if
//    header lines are left unchanged. Feel free to contact the author
//    for feature requests and/or donations
//linda liao's changes: 
// 1. use class name instead of specifying color index
// 2. more flexible by reading original class names so that it can be used to all FOS tables.
// 3. less arguments
function hlight_table (
		tableid, // table id (req.)
		num_header_offset, // how many rows to skip before applying effects at the begining (opt.)
		num_footer_offset, // how many rows to skip at the bottom of the table (opt.)
		class_mover // background color for rows with mouse over (opt.)
	) {

	 // skip non DOM browsers
	//if (typeof(document.all) != 'object') return;

	// validate required parameters
	if (!tableid) return alert ("No table(s) ID specified in parameters");
	var obj_table = document.getElementById(tableid);
	if (!obj_table) return alert ("Can't find table(s) with specified ID (" + tableid + ")");

	// set defaults for optional parameters
	var col_config = [];
	col_config.header_offset = (num_header_offset ? num_header_offset : 0);
	col_config.footer_offset = (num_footer_offset ? num_footer_offset : 0);
	col_config.class_mover = (class_mover? class_mover: 'over');
	
	tt_init_table(obj_table, col_config);
}

function tt_init_table (obj_table, col_config) {
	var col_last_config = [],
	col_trs = obj_table.rows;
	for (var i = col_config.header_offset; i < col_trs.length - col_config.footer_offset; i++) {
		col_trs[i].config = col_config;
                if (document.all) //ie4+
		col_trs[i].class_old = col_trs[i].getAttribute('className');
                else
		col_trs[i].class_old = col_trs[i].getAttribute('class');
		col_trs[i].lconfig = col_last_config;
		col_trs[i].set_class = tt_set_class;
		col_trs[i].onmouseover = tt_mover; 
		col_trs[i].onmouseout = tt_mout;
		//col_trs[i].onmousedown = tt_onclick;
	}
}
function tt_set_class(name) {
	this.className = name;
}

// event handlers
function tt_mover () {
	if (this.lconfig.clicked != this)
		this.set_class(this.config.class_mover);
}
function tt_mout () {
	if (this.lconfig.clicked != this)
		this.set_class(this.class_old);
}
function tt_onclick () {
	if (this.lconfig.clicked == this) {
		this.lconfig.clicked = null;
		this.onmouseover();
	}
	else {
		var last_clicked = this.lconfig.clicked;
		this.lconfig.clicked = this;
		if (last_clicked) last_clicked.onmouseout();
		this.set_class(this.config.class_mover);
	}
}
