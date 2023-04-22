import { useState, useEffect, useCallback, useRef } from "react";

import SearchBar from "./SearchBar";
import PlaceList from "./PlaceList";

function Find() {
    const [searchBarValue, setSearchBarValue] = useState("");
    const [places, setPlaces] = useState([]);
    const [autocomplete, setAutocomplete] = useState([]);
    const [resultsNum, setResultsNum] = useState(null);

    const searchBarInp = useRef();

    function getPlaces(searchBarValue) {
        console.debug("getPlaces"); //mmmyyy
        searchBarValue = searchBarValue.trim();
        if (3 > searchBarValue.length) {
            return;
        }
        axios
            .get(getPlacesUrl, {
                params: {
                    searchBarValue: searchBarValue,
                },
            })
            .then(function (response) {
                setPlaces(response.data.places);
                setResultsNum(response.data.places.length);
            })
            .catch(function (error) {
                console.log(error);
            });
    }

    function getAutocomplete(searchBarValue) {
        console.debug("autocomplete"); //mmmyyy
        axios
            .get(autocompleteUrl, {
                params: {
                    searchBarValue: searchBarValue.trim(),
                },
            })
            .then(function (response) {
                setAutocomplete(response.data.autocomplete);
            })
            .catch(function (error) {
                console.log(error);
            });
    }

    const getAutocompleteDebounce = useCallback(
        _.debounce(getAutocomplete, 1500),
        []
    );

    useEffect(() => {
        if (2 < searchBarValue.length) {
            getAutocompleteDebounce(searchBarValue);
        }
    }, [searchBarValue]);

    function changeHandler(e) {
        setSearchBarValue(e.currentTarget.value);
        setResultsNum(null);
    }

    function confirmHandler(e) {
        if ("find-btn" === e.currentTarget.id) {
            // find btn
            getPlaces(searchBarInp.current.value);
        } else if (e.keyCode === 13) {
            // enter key
            getPlaces(e.currentTarget.value);
        } else if (e.keyCode === 38) {
            // up arrow
        } else if (e.keyCode === 40) {
            // down arrow
        }
    }

    console.debug("Find"); //mmmyyy
    return (
        <div id="find">
            <SearchBar
                onChange={changeHandler}
                onConfirm={confirmHandler}
                searchBarValue={searchBarValue}
                autocomplete={autocomplete}
                reference={searchBarInp}
                resultsNum={resultsNum}
            />
            <PlaceList places={places} />
        </div>
    );
}

export default Find;
