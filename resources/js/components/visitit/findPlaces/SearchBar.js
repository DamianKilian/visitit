function SearchBar(props) {

    return (
        <div id="search-bar">
            <input className="form-control" onChange={props.onChange}/>
        </div>
    );
}

export default SearchBar;
