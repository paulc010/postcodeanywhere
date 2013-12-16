function getSelectedText(elementId) {
    var selectedcountry = document.getElementById(elementId);
    if (selectedcountry.selectedIndex == -1)
        return null;
    return selectedcountry.options[selectedcountry.selectedIndex].text;
}
var _fields = [{
    element: "company",
    field: "Company"
}, {
    element: "address1",
    field: "Line1"
}, {
    element: "address2",
    field: "Line2"
}, {
    element: "city",
    field: "City"
}, {
    element: "postcode",
    field: "PostalCode"
}, {
    element: "id_state",
    field: "State"
}, {
    element: "id_country",
    field: "Country"
}],
    _control = new pca.Address(_fields, _pcaoptions);

function search() {
    var _country = getSelectedText("id_country"),
        _postcode = pca.getValue(pca.getElement("postcode"));
    _control.searchByPostcode(_country, _postcode);
}

function clearFields() {
    _control.clear();
}

document.getElementById("postcode").parentNode.appendChild(new pca.Button("Find", search));
var _stateData = {
    "USA": {
        "AL": "Alabama",
        "AK": "Alaska",
        "AZ": "Arizona",
        "AR": "Arkansas",
        "CA": "California",
        "CO": "Colorado",
        "CT": "Connecticut",
        "DE": "Delaware",
        "DC": "District Of Columbia",
        "FL": "Florida",
        "GA": "Georgia",
        "HI": "Hawaii",
        "ID": "Idaho",
        "IL": "Illinois",
        "IN": "Indiana",
        "IA": "Iowa",
        "KS": "Kansas",
        "KY": "Kentucky",
        "LA": "Louisiana",
        "ME": "Maine",
        "MD": "Maryland",
        "MA": "Massachusetts",
        "MI": "Michigan",
        "MN": "Minnesota",
        "MS": "Mississippi",
        "MO": "Missouri",
        "MT": "Montana",
        "NE": "Nebraska",
        "NV": "Nevada",
        "NH": "New Hampshire",
        "NJ": "New Jersey",
        "NM": "New Mexico",
        "NY": "New York",
        "NC": "North Carolina",
        "ND": "North Dakota",
        "OH": "Ohio",
        "OK": "Oklahoma",
        "OR": "Oregon",
        "PA": "Pennsylvania",
        "PR": "Puerto Rico",
        "RI": "Rhode Island",
        "SC": "South Carolina",
        "SD": "South Dakota",
        "TN": "Tennessee",
        "TX": "Texas",
        "UT": "Utah",
        "VT": "Vermont",
        "VI": "Virgin Islands",
        "VA": "Virginia",
        "WA": "Washington",
        "WV": "West Virginia",
        "WI": "Wisconsin",
        "WY": "Wyoming"
    },
    "CAN": {
        "AB": "Alberta",
        "BC": "British Columbia",
        "MB": "Alabama",
        "NL": "Newfoundland and Labrador",
        "NB": "New Brunswick",
        "NS": "Nova Scotia",
        "NT": "Northwest Territories",
        "NU": "Nunavut",
        "ON": "Ontario",
        "PE": "Prince Edward Island",
        "QC": "Quebec",
        "SK": "Saskatchewan",
        "YT": "Yukon Territory"
    }
};
pca.listen(null, "select_address", function (selected) {
    if (selected.Address.State) selected.Address.State = ((_stateData[selected.Address.CountryCode] || {})[selected.Address.State] || selected.Address.State);
});