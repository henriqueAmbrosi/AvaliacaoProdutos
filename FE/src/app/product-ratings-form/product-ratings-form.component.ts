import { Component, OnInit, ViewChild } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { ProductRating } from '../product-rating';
import { ProductRatingsService } from '../product-ratings.service';

@Component({
  selector: 'app-product-ratings-form',
  templateUrl: './product-ratings-form.component.html',
  styleUrls: ['./product-ratings-form.component.css']
})
export class ProductRatingsFormComponent implements OnInit {

  item: ProductRating;
  errorFields: string[];
  errorMessages: string[];

  @ViewChild('alert') alert;

  constructor(protected route: ActivatedRoute, protected router: Router, private service: ProductRatingsService) {
    this.item = new ProductRating();
    this.item.grade = 0;
    this.errorFields = [];
    this.errorMessages = [];
   }

  ngOnInit(): void {
    let product_id: string = this.route.snapshot.paramMap.get('product_id');
    let id: string = this.route.snapshot.paramMap.get('id');

    if(product_id != null) {
      if(id != null) {
        this.service.getOne(parseInt(product_id), parseInt(id)).subscribe((data: any) => this.item = data);
      }else{
        this.item.product_id = parseInt(product_id);
      }
    }
  }

  save() {
    this.errorFields = [];
    this.errorMessages = [];
    console.log(this.item);
    if(this.item.id){
      this.service.update(this.item).subscribe(
        (data: any) => this.callbackSuccess(),
        (error: any) => this.callbackError(error),
      );
    }else{
      this.service.insert(this.item).subscribe(
        (data: any) => this.callbackSuccess(),
        (error: any) => this.callbackError(error),
      );
    }
  }

  isInvalidField(field){
    return (this.errorFields.indexOf(field) != -1);
  }

  private callbackSuccess(){
    this.router.navigate(['/produtos/' + this.item.product_id + '/avaliacoes'])
  }

  private callbackError(error: any){
    this.alert.type = "danger"
    Object.keys(error.error).map(field => {
      this.errorFields.push(field)
      error.error[field].map(msg => {
        this.errorMessages.push(msg)
      })
    });
      this.alert.messages = this.errorMessages
    if(error.status == 422){
      this.alert.message = "Não foi possível salvar o registro; Os campos destacados estão inválidos"
    }else{
      this.alert.message = "Ocorreu um problema ao salvar o registro"
    }

    console.log(error);
  }
}
