/**
 * @author:Nitin Pamnani and Prateek Singh Chauhan
 * Time 2:13 AM
 * Place Gurgaon, Haryana
 * Date 28/January/2017
 */
const USERS_STATUS_TAB = "userStatusTab";


function showManageUsersTab(tabId) {
	var elementToShow = document.getElementById("manageUsers");
	if (elementToShow != null && elementToShow != undefined) {
		if (tabId === USERS_STATUS_TAB) {

			var display = elementToShow.style.display;
			if (display == 'none') {
				elementToShow.style.display = 'block';
			}

		} else {
			elementToShow.style.display = 'none';
		}

	}

}
