import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { ProductRating } from './product-rating';

@Injectable({
  providedIn: 'root'
})
export class ProductRatingsService {

  baseUrl:String;
  headers: HttpHeaders

  constructor(private http: HttpClient) {
   this.baseUrl = "http://localhost:4200/api/produtos";

   this.headers = new HttpHeaders().set('Content-Type', 'aplication/json')
                                    .set('Accept', 'aplication/json')
                                    .set('Access-Control-Allow-Origin', '*')
                                    .set('Access-Control-Allow-Headers', '*')
                                    .set('Access-Control-Allow-Methods', 'GET, POST, PUT, PATCH, DELETE, OPTIONS');
  }

  getAll(product_id: number){
    let url = this.baseUrl + '/' + product_id + '/avaliacoes';
    return this.http.get<ProductRating[]>(url, {headers: this.headers});
  }

  getOne(product_id: number, id: number){
    let url = this.baseUrl + '/' + product_id + '/avaliacoes/' + id;
    return this.http.get<ProductRating>(url, {headers: this.headers});

  }

  insert(productRating: ProductRating){
    let url = this.baseUrl + '/' + productRating.product_id + '/avaliacoes';
    return this.http.post<any>(url, productRating, {headers: this.headers});

  }

  update(productRating: ProductRating){
    let url = this.baseUrl + '/' + productRating.product_id + '/avaliacoes/'+ productRating.id;

    return this.http.put<any>(url, productRating, {headers: this.headers});
  }

  delete(product_id: number, id: number){
    let url = this.baseUrl + '/' + product_id + '/avaliacoes/' + id;

    return this.http.delete<ProductRating>(url, {headers: this.headers});
  }
}
