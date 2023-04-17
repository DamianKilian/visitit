function Place(props) {
    console.debug("Place"); //mmmyyy
    return (
        <div className="place card">
            <div className="card-body">
                <h5 className="title card-title">{props.place.title}</h5>
                <h6 className="excerpt card-subtitle mb-2 text-muted">
                    {props.place.excerpt}
                </h6>
                <p className="content card-text">{props.place.textContent}</p>
                <a href="#" className="card-link">{__("See")}</a>
            </div>
        </div>
    );
}

export default Place;
