import { useState, useEffect, useCallback } from "react";

import SearchBar from "./SearchBar";
import PlaceList from "./PlaceList";

function Find() {
    const [searchBarValue, setSearchBarValue] = useState("");
    const [places, setPlaces] = useState([]);

    function getPlaces(searchBarValue) {
        axios
            .get(getPlacesUrl, {
                params: {
                    searchBarValue: searchBarValue,
                },
            })
            .then(function (response) {
                setPlaces(response.data.places);
            })
            .catch(function (error) {
                console.log(error);
            });
    }

    const getPlacesDebounce = useCallback(_.debounce(getPlaces, 1500), []);

    useEffect(() => {
        if (2 < searchBarValue.length) {
            getPlacesDebounce(searchBarValue);
        }
    }, [searchBarValue]);

    function changeHandler(e) {
        setSearchBarValue(e.currentTarget.value.trim());
    }

    return (
        <div id="find">
            <SearchBar onChange={changeHandler} />
            <PlaceList places={places} />
        </div>
    );
}

export default Find;
