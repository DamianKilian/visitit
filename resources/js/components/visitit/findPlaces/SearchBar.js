function SearchBar(props) {
console.debug('SearchBar');//mmmyyy
    return (
        <div id="search-bar">
            <input className="form-control" onChange={props.onChange} value={props.searchBarValue}/>
        </div>
    );
}

export default SearchBar;
