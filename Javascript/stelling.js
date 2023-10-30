let action;
let result;

let selectedParty = [];

$( document ).ready(function() {
    loadArrayBegin();
});

function loadArrayBegin() {
    let container = $('.containerStelling');

    // Find all child divs within the container
    var childDivs = container.find('div.stelling_record');

    // Iterate through each child div and log the text content
    childDivs.each(function () {
        var name = $(this).text().trim();
        selectedParty.push(name);
    });

    console.log(name);
    console.log(selectedParty);
}

function setAction(selectedActionOption) {
    action = selectedActionOption;
}
function checkDuplicates(partyName, partId, stellingId, actie) {
    let name = "-" + document.getElementById('selectedPartyForm').value;

    for (let i = 0; i < selectedParty.length; i++) {
        if (selectedParty[i] === name) {
            // Set the error message
            document.getElementById('formSelectError').style.display = 'flex';

            // Set result to true
            result = true;

            break;
        } else {
            document.getElementById('formSelectError').style.display = 'none';

            result = false;
        }
    }

    if (result === false) {
        if (action === "Eens") {
            addPartyEens(partyName, partId, stellingId, actie);
        } else if (action === "Oneens") {
            addPartyOneens(partyName, partId, stellingId,actie);
        } else {
            addPartyGeenMening(partyName, partId, stellingId,actie);
        }
    }
}

function addPartyEens(name,partyId, stellingId, actie) {
    const data = {
        partyId: partyId,
        stellingId: stellingId,
        mening: "eens",
        actie: actie
    };

    fetch('../../rest-api/bindStellingen.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
        .then(function(response) {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json(); // Parse the response as JSON
        })
        .then(function(data) {
            if (actie ==="toevoegen") {
                addNewDataEens(name, partyId, stellingId);
            } else {
                deleteData(name);
            }
        })
        .catch(function(error) {
            console.error('There was a problem with the fetch operation:', error);
        });

}

function addPartyGeenMening(name, partyId, stellingId, actie) {
    const data = {
        partyId: partyId,
        stellingId: stellingId,
        mening: "Geen mening",
        actie: actie
    };

    fetch('../../rest-api/BindStellingenGeenMening.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
        .then(function(response) {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json(); // Parse the response as JSON
        })
        .then(function(data) {
            if (actie === "toevoegen") {
                addNewDataGeenMening(name, partyId, stellingId);
            } else {
                deleteData(name);
            }
        })
        .catch(function(error) {
            console.error('There was a problem with the fetch operation:', error);
        });

}

function addPartyOneens(name, partyId, stellingId, actie) {
    const data = {
        partyId: partyId,
        stellingId: stellingId,
        mening: "Oneens",
        actie: actie

    };

    fetch('../../rest-api/BindStellingenOneens.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
        .then(function(response) {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json(); // Parse the response as JSON
        })
        .then(function(data) {
            if (actie === "toevoegen") {
                addNewDataOneens(name, partyId, stellingId);
            } else {
                deleteData(name);
            }
        })
        .catch(function(error) {
            console.error('There was a problem with the fetch operation:', error);
        });

}

function addNewDataEens (naam, partijId, stellingId) {
    $('#containerEens').append('<div class="stelling_record d-flex rounded" id="stellingPartyName_' + naam + '" style="justify-content: space-between">-' + naam + '<div><a href="#" class="fa fa-trash-o text-danger" style="font-size: 25px; text-decoration: none" aria-hidden="true" onclick="addPartyEens(' + naam + ',' + partijId + ',' + stellingId + ',\'verwijderen\')"></a></div></div>');

    selectedParty.push('-' + naam);
}

function deleteData (name) {
    $('#stellingPartyName_' + name).remove();

    selectedParty.splice(0, selectedParty.length);
    loadArrayBegin();
}

function addNewDataGeenMening (naam, partijId, stellingId) {
    $('#containerGeenMening').append('<div class="stelling_record d-flex rounded" id="stellingPartyName_' + naam + '" style="justify-content: space-between">-' + naam + '<div><a href="#" class="fa fa-trash-o text-danger" style="font-size: 25px; text-decoration: none" aria-hidden="true" onclick="addPartyEens(' + naam + ',' + partijId + ',' + stellingId + ',\'verwijderen\')"></a></div></div>');

    selectedParty.push('-' + naam);
}

function addNewDataOneens (naam, partijId, stellingId) {
    $('#containerOneens').append('<div class="stelling_record d-flex rounded" id="stellingPartyName_' + naam + '" style="justify-content: space-between">-' + naam + '<div><a href="#" class="fa fa-trash-o text-danger" style="font-size: 25px; text-decoration: none" aria-hidden="true" onclick="addPartyEens(' + naam + ',' + partijId + ',' + stellingId + ',\'verwijderen\')"></a></div></div>');

    selectedParty.push('-' + naam);
}