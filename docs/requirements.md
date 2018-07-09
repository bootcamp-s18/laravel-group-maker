# Laravel Group Maker

A generic platform that can be used for people to form and join groups.

The intent is for in-person meetings, but could also be used for virtual meetings.



## Pages

* Welcome - what users see before they log in.
* Home - what users see after they log in (unless they were attempting to access a restricted page, then they go to that one).
* Admins:
	* Create/update tag list
	* Block/ban users
	* Delete groups
	* Rule with an iron fist!
	* Set up systems and versions
* Anyone:
	* See their own groups
	* Create a new group
	* Update a group they already created
	* See users in their groups
	* Remove users from their groups
	* Approve requests from users trying to join their own private groups
	* Search for existing groups:
		* By tag
		* By radius from my location
		* By radius from another location
		* By group name/description
		* By creator (if group is public)
		* By activity


## Roles and Authentication

* Users should be able to self-register.
* Any registered, unblocked user should be able to join a public group or a private group by invitation.
* Any registered, unblocked user should be able to create a public or private group.


## Tagging

* Creators should be able to tag their groups.
* Admins should be in charge of tags; users can't make up their own.
* Anyone should be able to suggest a new tag to the admins.
* We do not need to tag activities.


## Database


### Participants

These are basically a user + a profile. Profile table will have user_id for linking the two.

One user to one profile.

### Users

* is_admin

### Profiles

* home_timezonex
* location (?)


### Groups

* id
* name
* creator_id
* description
* activity_id
* is_private (default = 0 for public group)
* is_accepting_members (default = 1 for yes)
* max_members 
* is_virtual (default = 0 for IRL)
* group_location (?)
* group_primary_timezone (default to creator's timezone)
* invitation_key


### Activities

* id
* name
* description



## Business Decisions

* We don't handle scheduling; that's up to the members of the group.
* When someone creates a group, default to their location and timezone but allow creator to choose new ones.
* We need the ability to block and ban.


