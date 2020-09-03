CREATE TABLE pages (
    post_comments int(11) unsigned DEFAULT '0' NOT NULL,
    post_comments_mode int(1) unsigned DEFAULT '0' NOT NULL,
);

CREATE TABLE tx_z7blog_domain_model_comment (
    uid int(11) NOT NULL auto_increment,
    lang varchar(2) DEFAULT '' NOT NULL,
	state int(11) unsigned NOT NULL default '0',
	firstname varchar(255) DEFAULT '' NOT NULL,
	lastname varchar(255) DEFAULT '' NOT NULL,
	email varchar(255) DEFAULT '' NOT NULL,
	url varchar(255) DEFAULT '' NOT NULL,
	comment text NOT NULL,
	children int(11) unsigned NOT NULL default '0',
	parent int(11) unsigned NOT NULL default '0',

	PRIMARY KEY (uid),
	KEY parent (pid)
);
