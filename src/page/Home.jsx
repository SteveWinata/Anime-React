import useFetch from "../logic/useFetch";

const Home = () => {
    const { data, isPending, error} = useFetch('http://127.0.0.1:8000/api/animes');
    return ( 
        <div className="container py-2">
            <h1 className="text-center mb-3 border-bottom">Anime list</h1>
            <div className="row row-gap-2 row-cols-1 row-cols-md-3 row-cols-lg-4 row-cols-sm-2 ">
                { data && data.animes.map(anime => (
                    <div className="col" key={anime.id}>
                        <div className="card">
                        <img src="https://source.unsplash.com/500x400?anime" className="card-img-top" alt="..." />
                        <div className="card-body">
                            <h5 className="card-title">{anime.title}</h5>
                            <p className="card-text">{ anime.synopsis.substr(0, 50) + '...' }</p>
                            <a href={ '/anime/' + anime.slug } className="btn btn-primary">See details</a>
                        </div>
                        </div>
                    </div>

                ))}
            </div>
        </div>
     );
}
 
export default Home;