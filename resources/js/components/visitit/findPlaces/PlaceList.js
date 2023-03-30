import Place from "./Place";

function PlaceList(props) {
    const listPlaces = props.places.map((place, index) => (
        <Place key={index} place={place} />
    ));
    return (
        <div id="place-list">
            {listPlaces}
        </div>
    );
}

export default PlaceList;
