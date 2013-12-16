Prestashop PostcodeAnywhere integration module
==============================================

Work in progress of a revised version of the postcodeanywhere.co.uk integration module


Usage
-------

In order to use this module you will need an account with PostcodeAnywhere and a Capture+ key. You can sign up for a [**free trial account**](https://www.postcodeanywhere.co.uk/partners/indiv73276.aspx) which gives you free trial credit to test things out on your site.

First you need to download the module to your Prestashop installation. Download the Zip file and extract it into the modules folder of your Prestashop installation. Once you have completed this you will need to rename the created directory from *postcodeanywhere-master* (GitHub convention) to *postcodeanywhere*.

To finalise the installation of the plugin, login to your PrestaShop admin panel and load the Modules page. Find the 'UK and International Address Auto-Fill' Module in the list of modules presented (it will be located under 'Billing and Invoicing' and click Install. You will then need to provide the module with your Capture+ key. Do this by clicking Configure for the installed module (you may need to refresh the page for the option to become available). Once you have entered your key click Update to save the changes to the module.

In order to customise the styling you should create a folder *modules/postcodeanywhere/css* in your theme root folder and then copy the *pca.css* file from the module folder into there as a basis to start your customisation. 

___

CHANGELOG
-------------

16/12/2013
-------------

Initial commit of upgraded version from v1.0

- Added backward_compatibility module (https://github.com/PrestaShop/PrestaShop-backward_compatibility).
- Revised module code to Prestashop 1.5.x.
- Revised to Prestashop 1.5 coding standards (http://doc.prestashop.com/display/PS15/Coding+Standards).
- Moved inline css to file to allow theme overrides if required.
- Moved inline javascript to external file.
