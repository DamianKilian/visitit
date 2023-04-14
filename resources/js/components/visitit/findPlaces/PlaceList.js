import Place from "./Place";

function PlaceList(props) {
    const listPlaces = props.places.map((place, index) => (
        <Place key={index} place={place.title} />
    ));
console.debug('PlaceList');//mmmyyy
    return (
        <div id="place-list">
            {listPlaces}
        </div>
    );
}

export default PlaceList;
