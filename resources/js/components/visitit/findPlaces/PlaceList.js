import Place from "./Place";

function PlaceList(props) {
    const places = props.places;
    return (
        <div id="place-list">
            {places.map((place) => {
                <Place
                    title={place.title}
                ></Place>;
            })}
        </div>
    );
}

export default PlaceList;
