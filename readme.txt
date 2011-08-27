#########################################################
#	Designed by gmobug (gmobug@gmobug.twbbs.org)	#
#	Site: http://mathml.twbbs.org			#
#########################################################

Database structure
	table mathml_topic
		field topic_id int
		field topic_subject text
	table mathml_message
		field topic_id int
		field message_id int
		field message_text text
		field message_author varchar(255)
		field message_pin varchar(32)
		field message_time int

create table mathml_topic (
topic_id int,
topic_subject text
);
create table mathml_message (
topic_id int,
message_id int,
message_text text,
message_author varchar(255),
message_pin varchar(32),
message_time int
);