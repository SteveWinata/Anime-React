import { useNavigate, useParams } from "react-router-dom";
import useFetch from "../logic/useFetch";
import axios from "axios";

const Detail = () => {
    const { slug } = useParams();
    const { data, isPending, error} = useFetch('http://127.0.0.1:8000/api/anime/' + slug);
    const navigate = useNavigate();
    const deleteAnime = async (id) => {
        try{
            const res = await axios.delete('http://127.0.0.1:8000/api/anime/' + id);
            console.log(res);
            navigate('/');
        }catch(e){
            console.log(e);
        }
    }
    // const editAnime = async (id) => {

    // }

    return ( 
    <div className="row row-cols-1 justify-content-center pe-4">
        <div className="col col-md-4 border-start border-end">
        {data && 
        <article className="pt-4 pb-4">
            <button onClick={() => deleteAnime(data.anime.id)} className="btn btn-danger mb-2 me-2">Delete</button>
            <button onClick={() => navigate('/anime/' + data.anime.slug + '/edit')} className="btn btn-warning mb-2">Edit</button>
            <h5>Producer : {data.anime.producer}</h5>
            <img src="https://source.unsplash.com/800x400?anime" className="card-img-top" alt="..." />
            <h3 className="card-title">{data.anime.title}</h3>
            <p className="card-text overflow-auto">{ data.anime.synopsis }</p>
        </article>
        }
        </div>
    </div>
    );
}
 
export default Detail;