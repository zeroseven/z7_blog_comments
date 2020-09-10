CREATE TABLE pages (
    post_comments int(11) unsigned DEFAULT '0' NOT NULL,
    post_comment_mode int(1) unsigned DEFAULT '0' NOT NULL,
);

CREATE TABLE tx_z7blog_domain_model_comment (
    uid int(11) NOT NULL auto_increment,
    sys_language_uid int(11) unsigned NOT NULL default '0',
    language_code varchar(2) DEFAULT '' NOT NULL,
	pending tinyint(1) unsigned DEFAULT '0' NOT NULL,
	name varchar(255) DEFAULT '' NOT NULL,
	email varchar(255) DEFAULT '' NOT NULL,
	url varchar(255) DEFAULT '' NOT NULL,
	text text NOT NULL,
	children int(11) unsigned NOT NULL default '0',
	parent int(11) unsigned NOT NULL default '0',
	remote_address varchar(255) DEFAULT '' NOT NULL,
	user_agent varchar(255) DEFAULT '' NOT NULL,
	permission_key varchar(255) DEFAULT '' NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid)
);
