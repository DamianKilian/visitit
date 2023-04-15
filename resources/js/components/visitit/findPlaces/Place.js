function Place(props) {
console.debug('Place');//mmmyyy
    return (
        <div className="place">
            <div className="title">{props.place.title}</div>
            <div className="excerpt">{props.place.excerpt}</div>
            <div className="content">{props.place.textContent}</div>
        </div>
    );
}

export default Place;
